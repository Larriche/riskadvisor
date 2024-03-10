<template>
    <div class="form-container px-10 w-10/12">
        <h1 class="text-2xl mb-1">Address Information</h1>

        <p class="font-thin text-gray-500">We can help with that! What is your address?</p>
        
        <div class="flex mt-5 gap-2 w-full">
            <div class="w-full">
                <label>Street Address</label>
                <input type="text" placeholder="Enter Street Address" v-model="addressInfo.street_address"/>
            </div>

            <div class="w-full">
                <label>Ste/Apt</label>
                <input type="text" v-model="addressInfo.apartment" placeholder="Apartment" />
            </div>
        </div>

        <div class="mt-5 w-full">
            <label>City *</label>
            <input type="text" placeholder="Enter city" v-model="addressInfo.city" />
            <small v-if="errors.city" class="text-red-500">{{  errors.city }}</small>
        </div>

        <div class="mt-5 mb-5 w-full">
            <label>State *</label>
            <select v-model="addressInfo.state_id">
                <option value="">Select a state</option>
                <option :value="state.id" v-for="state in states" :key="state.id">{{ state.code }}</option>
            </select>
            <small v-if="errors.state_id" class="text-red-500">{{  errors.state_id }}</small>
        </div>

        <div class="mt-5 w-full">
            <label>Zip Code *</label>
            <input type="text" placeholder="Enter zip code" v-model="addressInfo.zipcode" />
            <small v-if="errors.zipcode" class="text-red-500">{{  errors.zipcode }}</small>
        </div>

        <button class="btn btn-blue w-full mt-1" @click="handleSubmit">Continue</button>
        <button class="btn w-full mt-1 text-blue-500" @click="emit('previous')">Back</button>
    </div>
</template>

<script setup>
import { reactive } from 'vue';

const props = defineProps(['states', 'errors']);
const emit = defineEmits(['next', 'previous']);

const addressInfo = reactive({
    street_address: '',
    apartment: '',
    city: '',
    state_id: '',
    zipcode: ''
})

function handleSubmit() {
    emit('next', addressInfo);
}
</script>