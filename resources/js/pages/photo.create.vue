<template>
    <div class="container">

        <div class="jumbotron" style="text-align: center">
            <h1 class="display-4">Upload Photo</h1>
        </div>

        <div class="card">




            <div class="card-header">Upload Photo</div>

            <input type="file"  name="items" data-max-files="1" required style="margin: 20px"/>


        </div>
    </div>
</template>

<script>
    // Import Vue FilePond
    import * as FilePond from 'filepond';

    // Import FilePond styles
    import 'filepond/dist/filepond.min.css';


    export default {
        name: "photo-create",
        props: ['app'],

        mounted()
        {
            let $this = this;

            const inputElement = document.querySelector('input[type="file"]');

            FilePond.setOptions({
                server: BASE_URL + '/photo?album_id='+this.albumId,
                allowRevert: false,
                allowMultiple: false,
                instantUpload: false,

            });

            const pond = FilePond.create( inputElement );

            pond.on('processfile', (error, file) => {
                if (error) {
                    console.log(error);
                    return;
                }
                console.log(file);

                $this.goToAlbum($this.albumId);
            });
        },

        data: function() {
            return {
                albumId: this.app.$route.params.albumId,
            };
        },


        methods: {
            goToAlbum(id)
            {
                this.app.$router.push({
                    name: 'album.show',
                    params: {
                        id: id
                    }
                });
            }
        }
    }
</script>

<style>
    .filepond--root
    {
        margin: 20px;
    }
</style>