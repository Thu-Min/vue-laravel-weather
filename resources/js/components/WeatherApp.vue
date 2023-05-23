<template>
    <div class="">
        <div class="places-input text-gray-800 sm:text-center text-center">
            <input v-model="location.name" @keydown.enter="fetchData()" type="text" class="w-full bg-gray-50 h-10 pl-3 font-mono text-lg rounded-lg" placeholder="Enter City..."/>
        </div>

        <div class="weather-container font-sans w-full overflow-hidden rounded-lg bg-blue-300 shadow-lg mt-1">
            <div class="current-weather flex items-center justify-between px-6 py-8">
                <div class="flex items-center">
                    <div>
                        <div class="text-6xl text-black font-bold">{{ currentTemp.actual }}°C</div>
                        <div class="text-black font-bold pl-1">Feels like {{ currentTemp.feels }}°C</div>
                    </div>
                    <div class="mx-5">
                        <div class="text-black font-bold capitalize text-xl">{{ currentTemp.summary }}</div>
                        <div class="text-black font-bold text-lg">{{ location.name }}</div>
                    </div>
                </div>
                <div class="">
                    <img v-bind:src="'https://openweathermap.org/img/wn/' + currentTemp.icon + '.png'" alt="" width="50">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        mounted() {
            this.fetchData()
        },

        data() {
            return {
                currentTemp: {
                    actual: '',
                    feels: '',
                    summary: '',
                    icon: '',
                },

                location: {
                    name: 'Yangon',
                }
            }
        },

        methods: {
            fetchData() {
                fetch(`/api/weather?q=${this.location.name}`)
                    .then(response => response.json())
                    .then(data => {
                        this.location.name = data.name
                        this.currentTemp.actual = Math.round(data.main.temp)
                        this.currentTemp.feels = Math.round(data.main.feels_like)
                        this.currentTemp.summary = data.weather[0].description
                        this.currentTemp.icon = data.weather[0].icon
                    })
            }
        },
    }
</script>
