<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" 
                v-for="{title, author, id} in posts" :key="id"
                >
                    <div class="card-header">
                        {{title}}
                    </div>

                    <div class="card-body">
                        {{author}}
                    </div>
                </div>
                <!-- La chiamata genera un errore di tempistiche di caricamento file e img. valuta di mettere la richiesta al server in un metodo e richiamarlo al caricamento. -->
                <img 
                v-if="img.src.medium != null"
                :src="img.src.medium" alt="">
                <p
                v-else
                >Loading img</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
            img: [],
            authorization: '563492ad6f9170000100000143bbdc5af21e4ec6866c73937210208e',
            basePath: 'https://api.pexels.com/v1/photos/313690',
            }
            
        },
        props: ['posts'],
        mounted() {
            axios
      .get(this.basePath, {
        headers: {
        'Authorization': this.authorization,
        page: this.page
      }
      })
      .then(response => (this.img = response.data))
        },
    }
</script>
