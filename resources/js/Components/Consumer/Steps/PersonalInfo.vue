<template>
    <div class="form-container px-10 w-10/12">
        <h1 class="text-2xl mb-1">Personal Information</h1>

        <p class="font-thin text-gray-500">Ok, Great! Before we continue, please let us know how we can contact you regarding your quote.</p>
        
        <div class="flex mt-5 gap-2 w-full">
            <div class="w-full">
                <label>First name *</label>
                <input type="text" placeholder="Enter First Name" v-model="personalInfo.first_name"/>
                <small v-if="errors.first_name" class="text-red-500">{{  errors.first_name }}</small>
            </div>

            <div class="w-full">
                <label>Last name *</label>
                <input type="text" placeholder="Enter Last Name" v-model="personalInfo.last_name"/>
                <small v-if="errors.last_name" class="text-red-500">{{  errors.last_name }}</small>
            </div>
        </div>

        <div class="mt-5 w-full">
            <label>Email Address *</label>
            <input type="text" placeholder="Enter Email Address" v-model="personalInfo.email" />
            <small v-if="errors.email" class="text-red-500">{{  errors.email }}</small>
        </div>

        <div class="mt-5 w-full">
            <label>Phone No *</label>
            <input type="text" placeholder="Enter Phone No" v-model="personalInfo.phone" />
            <small v-if="errors.phone" class="text-red-500">{{  errors.phone }}</small>
        </div>

        <div class="mt-5 mb-5 w-full">
            <label>Contact Preference</label>
            <select v-model="personalInfo.contact_preference">
                <option value="phone">Phone</option>
                <option value="email">Email</option>
            </select>
            <small v-if="errors.contact_preference" class="text-red-500">{{  errors.contact_preference }}</small>
        </div>

        <button class="btn btn-blue w-full mt-1" :class="{'cursor-not-allowed': !allowContinue}" :disabled="!allowContinue" @click="handleSubmit">Continue</button>
        <button class="btn w-full mt-1 text-blue-500 text-lg" @click="emit('previous')">Back</button>
    </div>
</template>

<script setup>
import { reactive, computed } from 'vue';

const emit = defineEmits(['next', 'previous']);
const props = defineProps(['errors']);

const personalInfo = reactive({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    contact_preference: 'email'
})

const allowContinue = computed(() => {
    if (!personalInfo.first_name
        || !personalInfo.last_name 
        || !personalInfo.email
        || !personalInfo.phone 
        || !personalInfo.contact_preference
    ) {
        return false;
    }

    return true;
});

function handleSubmit() {
    emit('next', personalInfo);
}
</script>