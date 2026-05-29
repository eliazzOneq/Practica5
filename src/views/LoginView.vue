<template>
  <div>
    <h1>Login</h1>

    <form @submit.prevent="login">

      <input
        v-model="email"
        type="email"
        placeholder="Correo"
      />

      <br><br>

      <input
        v-model="password"
        type="password"
        placeholder="Contraseña"
      />

      <br><br>

      <button>
        Ingresar
      </button>

    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'

import { useRouter, useRoute } from 'vue-router'

const router = useRouter()
const route = useRoute()

const email = ref('')
const password = ref('')

const login = () => {
  // Login falso para práctica
  if (
    email.value === 'deJesusGuerrer0@gmail.com'
    &&
    password.value === '123456789'
  ) {
    localStorage.setItem('token', '123')
    router.push(
      route.query.redirect || '/admin'
    )
  } else {
    alert('Credenciales incorrectas')
  }
}
</script>