document.addEventListener('DOMContentLoaded', async () => {
    getUserLocation() 

    function getUserLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    fetchWeatherData(latitude, longitude);
                },
                (error) => {
                    console.error('Error getting user location:', error.message);
                }
            );
        } else {
            console.error('Geolocation is not supported by this browser.');
        }
    }

    function fetchWeatherData(latitude, longitude) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/getWeatherData', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken 
            },
            body: JSON.stringify({ latitude: latitude, longitude: longitude })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            updateUI(data);
        })
        .catch(error => {
            console.error('Error fetching weather data:', error);
        });
    }

    function updateUI(data) {
        const locationElement = document.querySelector('.location');
        const weatherIconElement = document.querySelector('.weather-icon');
        const temperatureElement = document.querySelector('.temperature');
        const descriptionElement = document.querySelector('.description');

        locationElement.textContent = data.name;
        if (data.weather_icon) {
            weatherIconElement.src = `https://openweathermap.org/img/wn/${data.weather_icon}.png`;
        }
        if (data.temp_celsius) {
            temperatureElement.textContent = `${data.temp_celsius}°C`;
        }
        if (data.description) {
            descriptionElement.textContent = data.description;
        }
    }
});
