<script>
import axios from 'axios';

export default {
    data() {
        return {}
    },
    methods: {
        apiRequest() {
            axios.get('http://127.0.0.1:8000/api/projects').then(r => {
                console.log('questa è la risposta', r)
            })

        }
    },
    mounted() {
        this.apiRequest()
    }

}

</script>

<template>
    <h1>CIAO sono VUE appena importato</h1>
</template>

<style></style>