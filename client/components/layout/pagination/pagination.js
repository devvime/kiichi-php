import './pagination.scss'
import element from './pagination.html'
import { state } from 'reactivity-proxy'

export const Pagination = {
  title: 'pagination-element',
  init() {},
  render() {
    return element
  },
  setPaginationData(pagination) {
    const paginationButtons = []
    pagination.buttons.forEach(page => {
      paginationButtons.push({
        index: page,
        url: `${location.pathname}?page=${page}`,
      })
    })
    state.change('paginationButtons', paginationButtons)
  }
}