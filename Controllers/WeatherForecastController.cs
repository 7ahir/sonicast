using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;
using System.IO;
using WeatherApp.Models;
using System.Net;
using System.Reflection;

namespace WeatherApp.Controllers
{
    [ApiController]
    [Route("weatherforecast")]
    public class WeatherForecastController : ControllerBase
    {
        private readonly ILogger<WeatherForecastController> _logger;

        public WeatherForecastController(ILogger<WeatherForecastController> logger)
        {
            _logger = logger;
        }

        [HttpGet("all")]
        public IActionResult Get()
        {
            try
            {
                List<City> cities = GetData();

                if (cities?.Any() == false)
                    return NotFound();

                return Ok(cities);
            }
            catch (Exception ex)
            {
                return StatusCode((int)HttpStatusCode.InternalServerError, ex.Message);
            }
        }


        [HttpGet("{cityName}")]
        public IActionResult GetCoordByCityName(string cityName)
        {
            try
            {
                List<City> cities = GetData();

                if (cities?.Any() == false)
                    return NotFound();

                var result = cities?.FirstOrDefault(x => string.Equals(x.CityName , cityName, StringComparison.OrdinalIgnoreCase));

                if(result == null)
                    return NotFound();

                return Ok(result);
            }
            catch (Exception ex)
            {
                return StatusCode((int)HttpStatusCode.InternalServerError, ex.Message);
            }
        }


        [HttpGet("cities")]
        public IActionResult GetCities()
        {
            try
            {
                List<City> cities = GetData();

                if (cities?.Any() == false)
                    return NotFound();

                return Ok(cities?.Select(i=> i.CityName)?.ToList()?.Distinct());
            }
            catch (Exception ex)
            {
                return StatusCode((int)HttpStatusCode.InternalServerError, ex.Message);
            }
        }


        public List<City> GetData()
        {
            List<City> cities = new List<City>();
            string path = "/app/Data/cities.txt";

            // This text is added only once to the file.
            if (!System.IO.File.Exists(path))
            {
                return null;
            }
            // Open the file to read from.
            string[] readText = System.IO.File.ReadAllLines(path);
            foreach (string s in readText)
            {
                var data = s.Split(',').ToList();
                cities.Add(new City
                {
                    CityName = data[0],
                    Latitude = decimal.Parse(data[1]),
                    Longitude = decimal.Parse(data[2]),
                    Country = data[3]
                });
            }
            return cities;
        }

    }
}
