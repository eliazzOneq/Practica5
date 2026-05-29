import axios from 'axios'

const api = axios.create({
  baseURL: 'http://127.0.0.1:8000/api'
})

export const getProductos = () => api.get('/productos')

export const getProducto = (id) =>
  api.get(`/productos/${id}`)

export const createProducto = (data) =>
  api.post('/productos', data)

export const updateProducto = (id, data) =>
  api.post(`/productos/${id}`, data)

export const deleteProducto = (id) =>
  api.delete(`/productos/${id}`)