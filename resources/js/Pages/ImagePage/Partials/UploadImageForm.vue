<script setup lang="js">
import { Button } from '@/Components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Toaster } from '@/Components/ui/toast';
import { useToast } from '@/Components/ui/toast/use-toast';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    image_description: null,
    image: null,
});

function submit() {
    form.post(route('image.store'));
    if (
        form.image_description != null &&
        form.image != null &&
        !form.errors.image &&
        !form.errors.image_description
    ) {
        toast({
            title: 'Uploaded',
            description: 'Successfully uploaded Image',
        });
    }
    form.reset();
}

const { toast } = useToast();
</script>

<template>
    <section class="flex justify-center">
        <Card class="w-[350px]">
            <CardHeader>
                <CardTitle>Upload Image</CardTitle>
                <CardDescription
                    >Upload Images to be used in posts.</CardDescription
                >
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit">
                    <div class="grid w-full items-center gap-4">
                        <div class="flex flex-col space-y-1.5">
                            <Label for="image_description">Description</Label>
                            <Input
                                type="text"
                                v-model="form.image_description"
                            />
                            <p
                                v-if="form.errors.image_description"
                                class="text-red-700"
                            >
                                Description Cannot be blank
                            </p>
                        </div>
                        <div class="flex flex-col space-y-1.5">
                            <Label for="image">Image</Label>
                            <Input
                                type="file"
                                @input="form.image = $event.target.files[0]"
                            />
                            <p v-if="form.errors.image" class="text-red-700">
                                Must Upload Image
                            </p>
                        </div>
                        <progress
                            v-if="form.progress"
                            :value="form.progress.percentage"
                            max="100"
                        >
                            {{ form.progress.percentage }}%
                        </progress>
                        <Toaster />
                        <Button id="upload" type="submit">Submit</Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </section>
</template>
