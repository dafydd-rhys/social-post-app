function fetchWeather() {
    const apiKey = '6fb70c93789ecf9407193cbac2c63f0a'; 
    const openWeatherUrl = 'https://api.openweathermap.org/data/2.5/weather';

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            position => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                const weatherUrl = `${openWeatherUrl}?lat=${latitude}&lon=${longitude}&appid=${apiKey}`;
                fetch(weatherUrl)
                    .then(response => response.json())
                    .then(weatherData => {
                        const city = weatherData.name;
                        const temperatureKelvin = weatherData.main.temp;
                        const description = weatherData.weather[0].description;
                        const iconCode = weatherData.weather[0].icon;
                        const iconUrl = `https://openweathermap.org/img/wn/${iconCode}.png`;
                        const temperatureCelsius = (temperatureKelvin - 273.15).toFixed(1);

                        document.querySelector('.location').textContent = city;
                        document.querySelector('.weather-icon').src = iconUrl;
                        document.querySelector('.temperature').textContent = `${temperatureCelsius}°C`;
                        document.querySelector('.description').textContent = description;
                    })
                    .catch(error => {
                        console.error('Error fetching weather data:', error);
                    });
            },
            error => {
                console.error('Error retrieving location:', error);
            }
        );
    } else {
        console.error('Geolocation is not supported by this browser.');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    fetchWeather();
});