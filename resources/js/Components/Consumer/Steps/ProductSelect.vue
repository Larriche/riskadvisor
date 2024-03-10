<template>
    <div class="form-container px-10 w-9/12">
        <h1 class="text-2xl mb-1">Let's get started</h1>

        <p class="font-thin text-gray-500">Please select one or more options below that you'd like to have quoted for insurance.</p>

        <ProductCard v-for="product in products" :product="product" :key="product.id" @change="(selected) => updateProductSelections(product.id, selected)"/>
        <small v-if="errors.product_ids" class="text-red-500">{{  errors.product_ids }}</small>

        <button :class="['btn btn-blue w-full mt-1', {'cursor-not-allowed': productIds.length == 0}]" :disabled="productIds.length == 0" @click="emit('next', productIds)">Agree and Continue</button>

        <p class="font-thin text-gray-500">By continuing this from you agree to share data with Franke Insurance Services as defined in the Terms of Use and Privacy Policy.</p>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import ProductCard from '../ProductCard.vue';

const props = defineProps(['products', 'errors']);
const emit = defineEmits(['next']);
const productIds = ref([]);

function updateProductSelections(productId, selected) {
    const ids = productIds.value;
    const index = ids.indexOf(productId);

    if (selected && index < 0) {
        ids.push(productId);
    }

    if (!selected && index >= 0) {
        ids.splice(index, 1);
    }

    productIds.value = ids;
}
</script>