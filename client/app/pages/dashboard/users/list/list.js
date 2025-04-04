import './list.scss'
import element from './list.html'
import { api } from '@services/baseApi.js'
import { state } from 'reactivity-proxy';
import { createUser } from '@pages/dashboard/users/create/create.js'
import { Pagination } from '@components/pagination/pagination.js'

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