<script setup>
import { computed, ref, watch } from "vue";

const props = defineProps({
    categories: Array,
    subCategories: Array,
    selectedCategoryId: String,
    selectedSubCategoryId: String,
});

const categoryId = ref(props.selectedCategoryId || null);

const subCategoryId = ref(props.selectedSubCategoryId || null);

const subCategoriesByCategory = computed(() =>
    props.subCategories.filter(
        ({ category_id }) => category_id == categoryId.value
    )
);

watch(categoryId, (currentCategoryId, prevCategoryId) => {
    subCategoryId.value = null;
});
</script>
<template>
    <div>
        <div class="mt-3">
            <label htmlFor="name" class="block text-sm font-semibold">
                Category
                <span class="text-red-700 ml-2 text-xs"> (Required) </span>
            </label>

            <select
                name="category_id"
                required
                v-model="categoryId"
                class="mt-1 focus:ring-cyan-500 focus:border-cyan-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
            >
                <option :value="null" selected disabled hidden>
                    Choose Category
                </option>

                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                >
                    {{ category.name }}
                </option>
            </select>
        </div>
        <div class="mt-3">
            <label htmlFor="name" class="block text-sm font-semibold">
                Sub Category
                <span class="text-red-700 ml-2 text-xs"> (Required) </span>
            </label>

            <select
                name="sub_category_id"
                required
                v-model="subCategoryId"
                class="mt-1 focus:ring-cyan-500 focus:border-cyan-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
            >
                <option :value="null" selected disabled hidden>
                    Choose Sub Category
                </option>

                <option
                    v-for="subCategory in subCategoriesByCategory"
                    :key="subCategory.id"
                    :value="subCategory.id"
                >
                    {{ subCategory.name }}
                </option>
            </select>
        </div>
    </div>
</template>
