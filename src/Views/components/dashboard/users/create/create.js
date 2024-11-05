import './create.scss'
import $ from 'jquery'
import Swal from 'sweetalert2'
import { api } from '../../../services/baseApi.js'
import { state } from '../../../state.js'

export const createUser = {
  init() {
    createForm()
  },
  component() {

  }
}

function createForm() {
  const form = $('#create-user-form')
  form.on('submit', (e) => {
    e.preventDefault()
    const formData = new FormData(e.target)
    const data = {
      name: formData.get('name'),
      email: formData.get('email'),
      password: formData.get('password')
    }
    sendCreateUser(data)
  })
}

async function sendCreateUser(data) {
  state.change('loading', true)
  await api.post('/api/user', data).then(res => {
    if (res.success) {
      Swal.fire({
        title: 'User created successfully!',
        icon:'success',
        confirmButtonText: 'OK'
      }).then(() => {
        state.change('loading', false)
        location.href = '/dashboard/users'
      })
    } else {
      Swal.fire({
        title: 'User created errorAn error occurred while creating the user!',
        icon: 'error',
        confirmButtonText: 'OK'
      })
      state.change('loading', false)
    }
  })
}