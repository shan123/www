
$logonserver=$env:logonserver
$logonserver=$logonserver.replace("\","")
$logonserver=$logonserver + ".ecicloud.com"

if($args.length -lt 8)
{
write-host "Please enter in Firstname LastName Password ClientDC PrimarySmtp NumberofActiveSync VPN(Y/N) Connectwise ID clienteciadmincredobject"
exit
}
$username = "eciadmin@ecicloud.com"
$password = cat C:\scripts\createusers\HD\securestring.txt | convertto-securestring -key (2,3,56,34,254,222,1,1,2,23,42,54,33,233,1,34,2,7,6,5,35,43,6,6,6,6,6,6,31,33,60,23)
$eciadmincred = new-object -typename System.Management.Automation.PSCredential -argumentlist $username, $password
$FirstName=$args[0]
$LastName=$args[1]
$Password=$args[2]
$ClientDC=$args[3]
$PrimarySmtpAlias=$args[4]
$NumActiveSync=$args[5]
$VPN=$args[6]
$Connectid=$args[7]
$clienteciadminpw=$args[8]
write-host " " 
write-host " " 
write-host "Name:"$FirstName $LastName
write-host "Client Domain Controller:"$ClientDC
write-host "PrimarySmtpAlias:"$PrimarySmtpAlias
write-host "Number of ActiveSync Devices:"$NumActiveSync
write-host "The User will have access to vpn:"$Vpn
$checkID=0
$checkname=0

$OUs=Get-ADOrganizationalUnit -filter * -searchbase "OU=Clients,DC=ecicloud,DC=com" -searchscope OneLevel -credential $eciadmincred
    foreach($Ou in $Ous)
    {
        if($Ou.StreetAddress -eq $Connectid)
        {
            $checkID=1
        }

     $tempsplit=$ClientDC.split(".")
        
        if($tempsplit[1].tolower() -eq $Ou.name)
        {
            $checkname=1
        }
    
    }#for OUs


        if($checkID -eq 0)
        {
            write-host "Connectwise ID not found"
            exit
        }
        if($checkname -eq 0)
        {
            write-host "Domain Controller FQDN is incorrect"
            exit
        }


$HomeDrive="P:"
$tempsplit=$ClientDC.Split(".")
$CompanyName=$tempsplit[1]
$CompanyName=$CompanyName.tolower()
$tempsplit=$PrimarySmtpAlias.split("@")
$SamAccountName=$tempSplit[0]
$SamAccountName=$SamAccountName.tolower()
$UserPrincipalName=$PrimarySmtpAlias
$name=$FirstName + " " + $LastName
$name=$name.trimend()
$Password=ConvertTo-SecureString $PassWord –AsPlainText –force
$ABP=(Get-AddressBookPolicy "$companyname*").name
$RecptCont="ecicloud.com/Clients/" + "$CompanyName" + "/Users"
$DBName=get-mailboxdatabase | where-object { $_.Name -like "$CompanyName*"}
$DBName=$DBName.Name
$DistroList="All" + $CompanyName
$GAL=$CompanyName + "GAL"
$clientdcsession=new-pssession -computername $ClientDC -Credential $clienteciadminpw

$clientdomaindn=invoke-command -session $clientdcsession -scriptblock {
import-module activedirectory 
get-addomain
}#
$clientdomain=$clientdomaindn.distinguishedname
$clientdomainfqdn=$clientdomaindn.forest
$input=$null
$OUs=invoke-command -session $clientdcsession -scriptblock {param($InClientDomain) Get-ADOrganizationalUnit -filter * -searchbase "$InClientDomain" -searchscope OneLevel} -argumentlist $clientdomain
$OUpath="OU=Users,"
foreach ($OU in $OUs)
{
if($OU.Name -eq "Boston" -or $OU.Name -eq "Connecticut" -or $OU.Name -eq "London" -or $OU.Name -eq "Minnesota" -or $OU.Name -eq "New York" -or $OU.Name -eq "San Fran"-or $OU.Name -eq "Los Angeles"-or $OU.Name -eq "Houston") 
{$OUpath=$OUpath + $OU.DistinguishedName}


}#end foreach OU

if($OUpath -eq "OU=Users,") 
{
$OUs=invoke-command -session $clientdcsession -scriptblock {param($InClientDomain) Get-ADOrganizationalUnit -filter {Name -like "Users"} -searchbase "$InClientDomain" } -argumentlist $clientdomain
$OUpath=$OUs.DistinguishedName
}
if($OUPath -eq "OU=Users,")
{
$OUpath="CN=Users," + $clientdomain
}



$HomeDirectory="\\" + $clientdomainfqdn +"\dfs\users\" + $samaccountname

invoke-command -session $clientdcsession -scriptblock {
	param ($InName,$InPassword,$inClientName,$InUserLastName,$InUserFirstName,$InUserPrincipalName, $inSamAccountName,$inPath,$inPrimarySmtpAlias,$inHomeDrive,$InHomeDirectory,$inVPN) 
import-module activedirectory
new-aduser "$Inname" -accountpassword $InPassword -ChangePasswordAtLogon $True -Company $inClientName -Surname $inUserLastName -GivenName $InUserFirstName -SamAccountName $inSamAccountName -path "$Inpath" -UserPrincipalName $InUserPrincipalName -EmailAddress $inPrimarySmtpAlias -enabled $True -HomeDrive "$inHomeDrive" -HomeDirectory $inHomeDirectory
if($inVPN -eq "Y")
{
	add-adgroupmember "VPN_Users" -members $inSamAccountName
}
	add-adgroupmember "citrix_all_users" -members $inSamAccountName
mkdir "E:\shares\users\$inSamAccountName"	
$domain=$InClientName
#sets use to Read,Write,Modify of E:\shares\users\$InSamAccountName
$colRights = [System.Security.AccessControl.FileSystemRights]"Read,Write,Modify" 
$InheritanceFlag = [System.Security.AccessControl.InheritanceFlags]::ContainerInherit
$PropagationFlag = [System.Security.AccessControl.PropagationFlags]::InheritOnly
$objType =[System.Security.AccessControl.AccessControlType]::Allow 
$objUser = New-Object System.Security.Principal.NTAccount("$domain\$InSamAccountName") 
$objACE = New-Object System.Security.AccessControl.FileSystemAccessRule ($objUser, $colRights, $InheritanceFlag, $PropagationFlag, $objType) 
$objACL = Get-ACL "e:\shares\users\$inSamAccountName" 
$objACL.AddAccessRule($objACE) 
Set-ACL "E:\shares\users\$inSamAccountName" $objACL
#sets domain users to Read,Write,Modify of E:\shares\users\$InSamAccountName
$colRights = [System.Security.AccessControl.FileSystemRights]"Read,Write,Modify" 
$InheritanceFlag = [System.Security.AccessControl.InheritanceFlags]::ObjectInherit
$PropagationFlag = [System.Security.AccessControl.PropagationFlags]::InheritOnly
$objType =[System.Security.AccessControl.AccessControlType]::Allow 
$objUser = New-Object System.Security.Principal.NTAccount("$domain\$InSamAccountName") 
$objACE = New-Object System.Security.AccessControl.FileSystemAccessRule ($objUser, $colRights, $InheritanceFlag, $PropagationFlag, $objType) 
$objACL = Get-ACL "e:\shares\users\$InSamAccountName" 
$objACL.AddAccessRule($objACE) 
Set-ACL "E:\shares\users\$InSamAccountName" $objACL
#sets domain users to Read,Write,Modify of E:\shares\users\$InSamAccountName
$colRights = [System.Security.AccessControl.FileSystemRights]"Read,Write,Modify" 
$InheritanceFlag = [System.Security.AccessControl.InheritanceFlags]::None
$PropagationFlag = [System.Security.AccessControl.PropagationFlags]::None
$objType =[System.Security.AccessControl.AccessControlType]::Allow 
$objUser = New-Object System.Security.Principal.NTAccount("$domain\$InSamAccountName") 
$objACE = New-Object System.Security.AccessControl.FileSystemAccessRule ($objUser, $colRights, $InheritanceFlag, $PropagationFlag, $objType) 
$objACL = Get-ACL "e:\shares\users\$InSamAccountName" 
$objACL.AddAccessRule($objACE) 
Set-ACL "E:\shares\users\$InSamAccountName" $objACL
} -ArgumentList $Name,$Password,$CompanyName,$LastName, $FirstName, $UserPrincipalName, $SamAccountName,"$OUPath",$PrimarySmtpAlias,$HomeDrive,$HomeDirectory,$VPN

$identity=$RecptCont + "/$samaccountname"
New-Mailbox -Name "$Name" -LinkedDomainController $ClientDC -LinkedMasterAccount $SamAccountName -AddressBookPolicy "$ABP" -Database $DBName -DisplayName "$name" -FirstName $FirstName -LastName $LastName -DomainController "$logonserver" -OrganizationalUnit "$RecptCont" -PrimarySMTPAddress $PrimarySmtpAlias
write-host "Sleeping 5 seconds for AD replicaiton" 
sleep(5)
set-mailbox -identity $PrimarySmtpAlias -RetentionPolicy "Empty Deleted Items After 30 Days" -DomainController "$logonserver" -CustomAttribute1 "$CompanyName" -EmailAddressPolicyEnable $true -SCLJunkEnabled $true -SCLJunkThreshold 8
$mailbox=get-mailbox -identity $PrimarySmtpAlias -domaincontroller "$logonserver"
$mailboxdn=$mailbox.DistinguishedName
set-aduser -identity "$mailboxdn" -company $CompanyName -server "$logonserver" -credential $eciadmincred
Add-DistributionGroupMember -Identity $DistroList -Member $PrimarySmtpAlias -DomainController "$logonserver" -BypassSecurityGroupManagerCheck
Update-GlobalAddressList -Identity "$GAL"
Update-AddressList -Identity $CompanyName

if ($NumActiveSync -gt 0)
    { 
    Set-CASMailbox -Identity $PrimarySmtpAlias -PopEnabled $false -ImapEnabled $false -ActiveSyncEnabled $True -ECPEnabled $False -DomainController "$logonserver"
    }
elseif($NumActiveSync -eq 0 -or $NumActiveSync -eq $null)
    {
    Set-CASMailbox -Identity $PrimarySmtpAlias -PopEnabled $false -ImapEnabled $false -ActiveSyncEnabled $false -ECPEnabled $False -DomainController "$logonserver"
    }
remove-pssession $clientdcsession
write-host "Replicating AD, the user should now be able to login Note OWA will not work till the setup their password"