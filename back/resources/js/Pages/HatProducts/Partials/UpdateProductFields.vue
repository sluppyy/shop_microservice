<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import NumberInput from '@/Components/NumberInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';

defineProps({
  product: Object
});

const product = usePage().props.product;

const form = useForm({
  _method: 'patch',
  name: product.name,
  description: product.description,
  preview: undefined, 
  price: product.price, 
  model: product.model, 
  custom_model_data: product.custom_model_data
});

function submit() {
    form.post(route('hatProducts.update', product.id), { enctype: 'multipart/form-data' })
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Product Information</h2>
        </header>

        <form
            @submit.prevent="submit"
            class="mt-6 space-y-6"
            enctype="multipart/form-data"
        >
            <h1 class="text-3xl font-bold">
                Id {{ product.id }}
            </h1>

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
                <img v-bind:src="'/' + product.preview_img_url" class="w-1/2">

                <InputError class="mt-2" :message="form.errors.preview" />
            </div>

            <div>
                <InputLabel>
                    Price

                    <NumberInput
                        type="number"
                        step="1"
                        class="mt-1 block w-full"
                        v-model="form.price"
                        required
                    />
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

                    <NumberInput
                        type="number"
                        step="1"
                        class="mt-1 block w-full"
                        v-model="form.custom_model_data"
                        required
                    />
                </InputLabel>

                <InputError class="mt-2" :message="form.errors.custom_model_data" />
            </div>

            <div>
                <p>
                    Created ad {{ product.created_at }}
                </p>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
