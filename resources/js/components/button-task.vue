<template>
    <div>
        <a class="btn btn-sm btn-pill btn-outline-info btn-block" :project_id ="project_id"  :file_id ="file" :minr ="min" >
            Descargar <i class="icon-docs"></i>
        </a>
    </div>
</template>

<script>
    export default {
        name: "button-task",
        props:['project_id','file_id','minr'],
        data(){
            return{
                project: this.project_id,
                file: this.file_id,
                min: this.minr
            }
        },
        mounted(){
            this.getfile();
        },methods:{
            getfile:function(){
                axios.get('/Archivos/',{
                    id:this.file,
                    project_id : this.project
                }).then(response=>{
                });
            }
        }

    }
</script>

<style scoped>

</style>