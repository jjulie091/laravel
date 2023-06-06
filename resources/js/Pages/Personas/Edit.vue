<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head,useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const props = defineProps({ persona:{type:Object}});
const form = useForm({
    nombre:props.nombre,
    ap_paterno:props.ap_paterno,
    ap_materno:props.ap_materno
});

const params = new URLSearchParams(window.location.search);

onMounted(
     
    () => {console.log(params.get('edit_url'))}
);
</script>

<template>
    <Head title="Editar Persona" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Persona</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="form.put(params.get('edit_url'))"
                    class="mt-6 space-y-6 max-w-xl">
                    <InputLabel for="nombre" value="Nombre"></InputLabel>
                    <TextInput id="nombre" v-model="form.nombre" autofocus required
                    type="text"
                    class="mt-1 block w-full"></TextInput>
                    <InputError :message="form.errors.nombre" class="mt-2"></InputError>
                    <br>
                    <InputLabel for="ap_paterno" value="Apellido Paterno"></InputLabel>
                    <TextInput id="ap_paterno" v-model="form.ap_paterno" autofocus required
                    type="text"
                    class="mt-1 block w-full"></TextInput>
                    <InputError :message="form.errors.ap_paterno" class="mt-2"></InputError>
                    <br>
                    <InputLabel for="ap_materno" value="Apellido Materno"></InputLabel>
                    <TextInput id="ap_materno" v-model="form.ap_materno" autofocus required
                    type="text"
                    class="mt-1 block w-full"></TextInput>
                    <InputError :message="form.errors.ap_materno" class="mt-2"></InputError>
                    <PrimaryButton :disabled="form.processing">
                        <i class="fa-solid fa-save"></i> Guardar
                    </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
