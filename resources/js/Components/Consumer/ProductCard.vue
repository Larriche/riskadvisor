<template>
    <div :class="[`product-card`, `widget-${product.system_name}`, {'selected': selected}]" @click="handleClick">
        <div class="icon">
            <img :src="getIconPath(product.system_name, 'icon')" class="bg-white rounded-lg h-50 w-50" />
        </div>

        <div class="px-2">
            <h2>{{  product.name }}</h2>
            <p class="font-thin">{{  product.description }}</p>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps(['product']);
const emit = defineEmits(['change']);
const selected = ref(false);

function handleClick() {
    selected.value = !selected.value;
    emit('change', selected.value);
}

function getIconPath(optionType) {
    return new URL(`../../../images/${optionType}_icon.png`, import.meta.url).href;
}
</script>

<style lang="scss">
.product-card {
    @apply flex bg-gradient-to-r from-blue-900 to-slate-400 text-white mt-3 mb-3 rounded-lg px-3 py-3 relative cursor-pointer;
}

.product-card.selected {
    @apply border-4 border-teal-500 bg-gradient-to-r from-blue-900 to-slate-500;
}

.product-card.selected:before {
    content: "";
    position: absolute;
    top: 20px;
    right: 25px;
    transform: rotate(45deg);
    height: 25px;
    width: 12px;
    border-bottom: 2px solid #fff;
    border-right: 2px solid #fff;
}

.icon img {
    height: 50px;
    width: 50px;
}
</style>