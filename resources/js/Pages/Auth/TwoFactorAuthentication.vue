<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    'code':''
});

const submit = () => {
    form.post(route('phone.verify.code'),
    {
        onFinish: () => form.reset('password'),
    });
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <GuestLayout>
        <Head title="Phone Verification" />

        <div class="mb-4 text-sm text-gray-600">
            Verify your phone number to continue!
        </div>

        <div
            v-if="$page.props.flash.message"
            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert"
        >
            <span class="font-medium">
                {{ $page.props.flash.message }}
            </span>
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="code" value="code" />

                <TextInput
                    id="code"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.code"
                    required
                    autofocus
                    placeholder="Enter otp"
                />

                <InputError class="mt-2" :message="form.errors.code" />
            </div>

            
            <div class="mt-4 flex items-center justify-between">
                
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Verification Code
                </PrimaryButton>

                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >Resend code</Link
                >
                <!-- <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >Log Out</Link
                > -->
            </div>
        </form>
    </GuestLayout>
</template>
