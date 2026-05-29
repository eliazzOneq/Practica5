<template>
  <div>
    <h1>Catálogo</h1>

    <input
      v-model="busqueda"
      placeholder="Buscar producto"
    />

    <div
      v-for="producto in productosPaginados"
      :key="producto.id">

      <img
        v-if="producto.imagen_url"
        :src="producto.imagen_url"
        :alt="producto.nombre"
        width="200"
      />

      <h3>{{ producto.nombre }}</h3>

      <p>${{ producto.precio }}</p>

      <router-link
        :to="`/catalogo/${producto.id}`"
      >Ver detalle</router-link>

      <br><br>

      <button @click="carrito.agregar(producto)">

        <template
          v-if="
            carrito.cantidadDeProducto(producto.id) > 0
          "
        >
          En carrito
          (
          {{
            carrito.cantidadDeProducto(producto.id)
          }}
          )
        </template>

        <template v-else>Agregar al carrito</template>

      </button>
      <hr>
    </div>

    <button @click="pagina--" :disabled="pagina === 1">Anterior</button>
    <button @click="pagina++">Siguiente</button>

  </div>
</template>

<script setup>

import {ref, computed, onMounted } from 'vue'

import { getProductos } from '@/services/productoService'

import { useCarritoStore } from '@/stores/carrito'

const carrito = useCarritoStore()
const productos = ref([])
const busqueda = ref('')

const pagina = ref(1)
const porPagina = 10
const productosPaginados = computed(() => {

  const inicio =
    (pagina.value - 1)
    * porPagina
  return productosFiltrados.value.slice(
    inicio,
    inicio + porPagina
  )
})

const productosFiltrados = computed(() =>
  productos.value.filter(p =>
    p.nombre
      .toLowerCase()
      .includes(busqueda.value.toLowerCase())
  )
)

onMounted(async () => {
  const response = await getProductos()
  productos.value = response.data
})

</script>