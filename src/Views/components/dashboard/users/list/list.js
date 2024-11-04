import './list.scss'
import element from './list.html'
import $ from 'jquery'
import Swal from 'sweetalert2'
import { api } from '../../../services/baseApi.js'
import { state } from '../../../state.js'

state.change('users', [])

export const listUsers = {
  async init() {
    await getUsers()
  },
  render() {
    return element
  }
}

async function getUsers() {
  await api.get('/api/user').then(res => {
    state.change('users', res.data)
    console.log(res.data)
  })
}