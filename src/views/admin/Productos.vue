<script setup>
  import { ref, onMounted } from 'vue'

  import {
    getProductos,
    createProducto,
    updateProducto,
    deleteProducto
  } from '@/services/productoService'

  const productos = ref([])
  const editando = ref(false)

  const imagen = ref(null)
  const preview = ref(null)

  const form = ref({
    id:null,
    nombre:'',
    descripcion:'',
    precio:'',
    stock:''
  })

  const cargarProductos = async()=>{
    const response = await getProductos()
    productos.value = response.data
  }

  const onImageChange = (e) => {
    const file = e.target.files[0]
    if (!file) return
    imagen.value = file
    preview.value =
      URL.createObjectURL(file)
  }

  const guardarProducto = async()=>{
    try{
      const fd = new FormData()

      fd.append('nombre', form.value.nombre)
      fd.append('descripcion', form.value.descripcion)
      fd.append('precio', form.value.precio)
      fd.append('stock', form.value.stock)

      if(imagen.value){
        fd.append('imagen', imagen.value)
      }

      if(editando.value){
        fd.append('_method', 'PUT')
        await updateProducto(
          form.value.id,
          fd
        )

      } else {
        await createProducto(fd)
      }

      limpiarFormulario()
      await cargarProductos()
      alert('Producto guardado correctamente')

    } catch(error){
      alert('Ocurrió un error.')
      console.error(error)
    }
  }

  const editarProducto=(producto)=>{
    editando.value=true
    form.value={...producto}
    preview.value = producto.imagen_url
  }

  const limpiarFormulario=()=>{
    editando.value=false
    form.value={
      id:null,
      nombre:'',
      descripcion:'',
      precio:'',
      stock:''
    }

    imagen.value = null
    preview.value = null
  }

  const eliminarProducto=async(id)=>{
    if(confirm('¿Eliminar producto?')){
      await deleteProducto(id)
      await cargarProductos()
      alert('Producto eliminado')
    }
  }

  onMounted(()=>{
    cargarProductos()
  })
</script>

<template>
  <h1>CRUD Productos</h1>
  <h2>
    {{ editando
    ? 'Editar Producto'
    : 'Nuevo Producto'
    }}
  </h2>

  <input v-model="form.nombre" placeholder="Nombre"/>
  <input v-model="form.descripcion" placeholder="Descripción"/>
  <input v-model="form.precio" type="number" placeholder="Precio"/>
  <input v-model="form.stock" type="number" placeholder="Stock"/>

  <div v-if="preview">
    <img :src="preview" width="200"/>
  </div>

  <input type="file" accept="image/*" @change="onImageChange"/>

  <button @click="guardarProducto">
    {{ editando
    ? 'Actualizar'
    : 'Guardar'
    }}
  </button>

  <button v-if="editando" @click="limpiarFormulario">Cancelar</button>
  <hr>
  <ul>
    <li v-for="producto in productos" :key="producto.id">
      {{ producto.nombre }} - ${{ producto.precio }} - Stock: {{ producto.stock }}

      <img v-if="producto.imagen_url" :src="producto.imagen_url" width="100"/>

      <button @click="editarProducto(producto)">Editar</button>

      <button @click="eliminarProducto(producto.id)">Eliminar</button>
    </li>
  </ul>
</template>