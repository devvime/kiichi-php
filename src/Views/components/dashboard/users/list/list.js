import './list.scss'
import element from './list.html'
import $ from 'jquery'
import Swal from 'sweetalert2'
import { api } from '../../../services/baseApi.js'
import { state } from '../../../state.js'

import { createUser } from '../create/create.js'

export const listUsers = {
  async init() {
    state.change('loading', true)
    createUser.init()
    await getUsers()
  },
  render() {
    return element
  }
}

async function getUsers() {
  await api.get(`/api/user${location.search}`).then(res => {
    if (res.data.length > 0) {
      state.change('users', res.data)
      state.change('pagination', res.pagination)

      const paginationButtons = []
      res.pagination.buttons.forEach(page => {
        paginationButtons.push({
          index: page,
          url: `${location.pathname}?page=${page}`,
        })
      })
      state.change('paginationButtons', paginationButtons)
      state.change('loading', false)
    } else {
      state.change('noData', true)
    }
  })
}