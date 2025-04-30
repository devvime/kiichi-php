import './mult-select.scss'
import element from './mult-select.html'

import { state } from 'reactivity-proxy';
import { emit } from 'blots'

export const MultiSelect = {
    title: 'multi-select-element',
    init() {},
    render() {
        return element
    },
    change() {
        const elements = document.querySelectorAll(MultiSelect.title)
        elements.forEach(element => {
            const multiSelect = element.querySelector(".multi-select")
            const selectBox = element.querySelector(".select-box")
            const options = element.querySelector(".options")

            const name = element.getAttribute('data-name')
            const dataItems = element.getAttribute('data-items')
            const items = state.get()[dataItems]
            options.setAttribute('data-for', 'item of state.'+dataItems+'Items')
            state.change(dataItems+'Items', items)

            selectBox.textContent = element.getAttribute('data-placeholder')
            selectBox.addEventListener("click", () => {
                multiSelect.classList.toggle("open");
            });

            options.addEventListener("change", () => {
                const checked = options.querySelectorAll("input:checked");
                const selected = Array.from(checked).map(input => input.parentNode.textContent.trim().split(' - ')[0]);
                const selectedValues = Array.from(checked).map(input => input.parentNode.textContent.trim().split(' - ')[1]);
                selectBox.textContent = selected.length > 0 ? selected.join(", ") : element.getAttribute('data-placeholder');
                emit(name, selectedValues)
            });

            document.addEventListener("click", (e) => {
                if (!multiSelect.contains(e.target)) {
                    multiSelect.classList.remove("open");
                }
            });
        })
    }
}
