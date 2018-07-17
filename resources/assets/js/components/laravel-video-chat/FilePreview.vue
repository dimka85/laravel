<template>
    <div class="col-md-3">
        <img :src="file.file_details.webPath" alt="" class="img-fluid" :alt="file.name">
        <a class="btn btn-success" :href="file.file_details.webPath" target="_blank" download :title="file.name">Скачать</a>
    </div>
</template>

<script>
    export default {
        props: ['file']
    }
</script>
