require('./bootstrap');

import { createApp } from 'vue'
import CategorySubCategoryInput from './components/CategorySubCategoryInput.vue'

const app = createApp({})

app.component('category-subcategory-input', CategorySubCategoryInput)

app.mount('#app')
