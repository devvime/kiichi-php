import './list.scss'
import element from './list.html'
import { api } from '@services/baseApi.js'
import { state } from 'reactivity-proxy';
import { createUser } from '@pages/dashboard/users/create/create.js'
import { pagination } from '@components/pagination/pagination.js'

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
      pagination.setPaginationData(res.pagination)
      state.change('users', res.data)
      state.change('pagination', res.pagination)
    } else {
      state.change('noData', true)
    }
  })
  state.change('loading', false)
}