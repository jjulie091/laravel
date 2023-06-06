<script setup>
import { defineProps, onMounted} from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({ autos:{type:Object}});

const params = new URLSearchParams(window.location.search)

onMounted(
     
    () => {console.log(params.get('edit_url'))}
);

const form = useForm({
    nombre_carro:props.nombre_carro,
    año:props.año,
    persona_id:props.persona_id,
    modelo_id:props.modelo_id
});

</script>

<template>
    <Head title="Editar Auto" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Auto</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <form @submit.prevent="form.put(params.get('edit_url'))" class="mt-6 space-y-6 max-w-xl">
                    
                    <InputLabel for="nombre_carro" value="Nombre del Auto"></InputLabel>
                    <TextInput id="nombre_carro" v-model="form.nombre_carro" autofocus required
                    type="text" 
                    class="mt-1 block w-full"></TextInput>
                    <InputError :message="form.errors.nombre_carro" class="mt-2"></InputError>
                    <br>
                    <InputLabel for="año" value="Año"></InputLabel>
                    <TextInput id="año" v-model="form.año" autofocus required
                    type="text" 
                    class="mt-1 block w-full"></TextInput>
                    <InputError :message="form.errors.año" class="mt-2"></InputError>
                    <br>
                    <InputLabel for="persona_id" value="Persona id"></InputLabel>
                    <TextInput id="persona_id" v-model="form.persona_id" autofocus required
                    type="text" 
                    class="mt-1 block w-full"></TextInput>
                    <InputError :message="form.errors.persona_id" class="mt-2"></InputError>
                    <br>
                    <InputLabel for="modelo_id" value="Modelo id"></InputLabel>
                    <TextInput id="modelo_id" v-model="form.modelo_id" autofocus required
                    type="text" 
                    class="mt-1 block w-full"></TextInput>
                    <InputError :message="form.errors.modelo_id" class="mt-2"></InputError>
                    <PrimaryButton :disabled="form.processing">
                        <i class="fa-solid fa-save"></i> Guardar
                    </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>