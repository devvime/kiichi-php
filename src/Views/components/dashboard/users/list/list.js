import './list.scss'
import element from './list.html'
import $ from 'jquery'
import Swal from 'sweetalert2'
import { api } from '../../../services/baseApi.js'
import { state } from 'reactivity-proxy';

import { createUser } from '../create/create.js'
import { Pagination } from '../../../layout/pagination/pagination.js'

export const listUsers = {
  title: 'list-users',
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
      Pagination.setPaginationData(res.pagination)
      state.change('loading', false)
    } else {
      state.change('noData', true)
    }
  })
}