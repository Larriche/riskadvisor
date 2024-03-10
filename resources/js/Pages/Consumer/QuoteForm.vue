<template>
    <div class="consumer-page h-full grid grid-cols-2 gap-10">
        <div :class="['left-col', currentImageClass]"></div>

        <div class="right-col">
            <ProductSelect
                v-show="currentPage == LANDING_STEP" 
                :products="products" 
                :errors="form.errors" 
                @next="(productIds) => handleProductDataSubmit(productIds)" />

            <PersonalInfo v-show="currentPage == PERSONAL_INFO_STEP" 
                :errors="form.errors"@next="(data) => handlePersonalInfoSubmit(data)" 
                @previous="currentPage = LANDING_STEP" />

            <AddressInfo v-show="currentPage == ADDRESS_STEP" 
                :states="states" :errors="form.errors" 
                @next="(data) => handleAddressInfoSubmit(data)" @previous="currentPage = PERSONAL_INFO_STEP"/>

            <SubmissionFeedback v-show="currentPage == DONE" />
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';

import ProductSelect from '@/Components/Consumer/Steps/ProductSelect.vue';
import PersonalInfo from '@/Components/Consumer/Steps/PersonalInfo.vue';
import AddressInfo from '@/Components/Consumer/Steps/AddressInfo.vue';
import SubmissionFeedback from '@/Components/Consumer/SubmissionFeedback.vue';

const LANDING_STEP = 'landing_step';
const PERSONAL_INFO_STEP = 'personal_info';
const ADDRESS_STEP = 'address_step';
const DONE = 'done';

const currentPage = ref(LANDING_STEP);
const props = defineProps(['products', 'states']);

const currentImageClass = computed(() => {
    if (currentPage.value == LANDING_STEP) {
        return 'home';
    }

    if (currentPage.value == PERSONAL_INFO_STEP) {
        return 'personal';
    }

    return 'address';
});

const form = useForm({
    product_ids: [],
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    contact_preference: 'email',
    street_address: '',
    apartment: '',
    city: '',
    state_id: '',
    zipcode: ''
});

function handleProductDataSubmit(productIds) {
    form.product_ids = productIds;

    currentPage.value = PERSONAL_INFO_STEP;
}

function handlePersonalInfoSubmit(data) {
    form.first_name = data.first_name;
    form.last_name = data.last_name;
    form.email = data.email;
    form.phone = data.phone;
    form.contact_preference = data.contact_preference;

    currentPage.value = ADDRESS_STEP;
}

function handleAddressInfoSubmit(data) {
    form.street_address = data.street_address;
    form.apartment = data.apartment;
    form.city = data.city;
    form.state_id = data.state_id;
    form.zipcode = data.zipcode;

    form.post('/quote', {
        onSuccess: () => currentPage.value = DONE
    });
}
</script>

<style lang="scss">
.left-col {
    &.home {        
        background-image: url("../../../images/home.png");
    }

    &.personal {        
        background-image: url("../../../images/personal.png");
    }

    &.address {        
        background-image: url("../../../images/address.png");
    }

    background-size: 100% 100%;
    background-repeat: no-repeat;
    background-position: 0;    
}
</style>
