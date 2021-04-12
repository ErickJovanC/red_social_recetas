<template>
    <span v-text="formaterFecha"></span> 
    <!-- Esto se verá en la vista, v-text llama la función formaterarFecha -->
</template>

<script>
    export default{
        props: ['fecha'], // Se recibe la variable
        
        mounted() {
            console.log('La fecha es', this.fecha); // Se muestra en la consola tal como se recibe
        },

        computed: {
            formaterFecha() {
                // Se cambia el formato de la fecha con moment y es devuelto el resultado
                return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY')
            }
        }
    }
</script>
