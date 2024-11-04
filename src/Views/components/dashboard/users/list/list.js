import './list.scss'
import element from './list.html'
import $ from 'jquery'
import Swal from 'sweetalert2'
import { api } from '../../../services/baseApi.js'
import { state } from '../../../state.js'

export const listUsers = {
  async init() {
    state.change('loading', true)
    await getUsers()
  },
  render() {
    return element
  }
}

async function getUsers() {
  await api.get('/api/user').then(res => {
    if (res.data.length > 0) {
      state.change('users', res.data)
      state.change('loading', false)
    } else {
      state.change('noData', true)
    }
  })
}