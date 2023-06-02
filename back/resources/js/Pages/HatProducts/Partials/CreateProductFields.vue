<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';

defineProps({
  product: Object
});

const product = usePage().props.product;

const form = useForm({
  name: '',
  description: '',
  preview: undefined, 
  price: 0, 
  model: '', 
  custom_model_data: 0
});

function submit() {
    form.post(route('hatProducts.store'))
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Product Information</h2>
        </header>

        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <div>
                <InputLabel>
                    Name
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                    />
                </InputLabel>

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel>
                    Description

                    <TextInput
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.description"
                        required
                    />
                </InputLabel>

                <InputError class="mt-2" :message="form.errors.description" />
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">
                    Preview
                    <input
                        type="file"
                        accept=".png, .jpeg, .svg, .jpg, .gif"
                        @input="form.preview = $event.target.files[0]"
                        name="preview">
                </label>
                <InputError class="mt-2" :message="form.errors.preview" />
            </div>

            <div>
                <InputLabel>
                    Price

                    <input
                      class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                      v-model="form.price"
                      required
                      type="number"
                      ref="input"/>
                </InputLabel>

                <InputError class="mt-2" :message="form.errors.price" />
            </div>

            <div>
                <InputLabel>
                    Model

                    <TextInput
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.model"
                        required
                    />
                </InputLabel>

                <InputError class="mt-2" :message="form.errors.model" />
            </div>

            <div>
                <InputLabel>
                    Custom model data

                    <input
                      class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                      v-model="form.custom_model_data"
                      required
                      type="number"
                      ref="input"/>
                </InputLabel>

                <InputError class="mt-2" :message="form.errors.custom_model_data" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Create</PrimaryButton>
            </div>
        </form>
    </section>
</template>
