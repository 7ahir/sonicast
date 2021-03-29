using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace WeatherApp.Models
{
    public class City
    {
        public string CityName { get; set; }
        public decimal Latitude  { get; set; }
        public decimal Longitude { get; set; }  
        public string Country { get; set; }
    }
}
