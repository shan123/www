using System;
using System.Collections.ObjectModel;
using ToolDepot.Core.Domain.Customers;

namespace ToolDepot.Services.Helpers
{
    /// <summary>
    /// Represents a datetime helper
    /// </summary>
    public partial interface IDateTimeHelperService
    {
    
        /// <summary>
        /// Retrieves a System.TimeZoneInfo object from the registry based on its identifier.
        /// </summary>
        /// <param name="id">The time zone identifier, which corresponds to the System.TimeZoneInfo.Id property.</param>
        /// <returns>A System.TimeZoneInfo object whose identifier is the value of the id parameter.</returns>
        TimeZoneInfo FindTimeZoneById(string id);

        /// <summary>
        /// Returns a sorted collection of all the time zones
        /// </summary>
        /// <returns>A read-only collection of System.TimeZoneInfo objects.</returns>
        ReadOnlyCollection<TimeZoneInfo> GetSystemTimeZones();

        DateTime ConvertToUtcTime(DateTime dt);

        /// <summary>
        /// Converts the date and time to Coordinated Universal Time (UTC)
        /// </summary>
        /// <param name="dt">The date and time (respesents local system time or UTC time) to convert.</param>
        /// <param name="sourceDateTimeKind">The source datetimekind</param>
        /// <returns>A DateTime value that represents the Coordinated Universal Time (UTC) that corresponds to the dateTime parameter. The DateTime value's Kind property is always set to DateTimeKind.Utc.</returns>
        DateTime ConvertToUtcTime(DateTime dt, DateTimeKind sourceDateTimeKind);

        /// <summary>
        /// Converts the date and time to Coordinated Universal Time (UTC)
        /// </summary>
        /// <param name="dt">The date and time to convert.</param>
        /// <param name="sourceTimeZone">The time zone of dateTime.</param>
        /// <returns>A DateTime value that represents the Coordinated Universal Time (UTC) that corresponds to the dateTime parameter. The DateTime value's Kind property is always set to DateTimeKind.Utc.</returns>
        DateTime ConvertToUtcTime(DateTime dt, TimeZoneInfo sourceTimeZone);

        /// <summary>
        /// Gets a customer time zone
        /// </summary>
        /// <param name="customer">Customer</param>
        /// <returns>Customer time zone; if customer is null, then default store time zone</returns>
        TimeZoneInfo GetCustomerTimeZone(Customer customer);

        /// <summary>
        /// Gets or sets a default store time zone
        /// </summary>
        TimeZoneInfo DefaultStoreTimeZone { get; set; }

        /// <summary>
        /// Gets or sets the current user time zone
        /// </summary>
        //TimeZoneInfo CurrentTimeZone { get; set; }

        double ConvertToUnixTimestamp(DateTime date);

        DateTime ConvertFromUnixTimestamp(double timestamp);

        //string GetFriendlyDateTimeDescription(DateTime datetime, bool convertToUserTimeZone = false);
    }
}
