<template>
    <input 
        type="submit" 
        class="btn btn-danger w-100 mb-2" 
        value="Eliminar"
        v-on:click="eliminarReceta"    
    >
</template>

<script>
export default {
    props: ['recetaId'],
    mounted() {
        console.log('receta actual', this.recetaId)
    },
    methods: {
        eliminarReceta(){
            /* this.$swal({
                title: '¿Eliminar Receta?',
                text: "¡Una vez eliminada no se pede cancelar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$swal({
                        title: 'Receta eliminada',
                        text: 'Se elimino la receta',
                        icon: 'success'
                    })
                }
            })           */
            this.$swal({
                title: 'Probando alerta',
                text: 'Funciona bien!',
                icon: 'success'
            })
        }
    }
}
</script>