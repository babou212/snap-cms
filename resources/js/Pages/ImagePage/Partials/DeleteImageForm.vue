<script setup lang="js">
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Label } from '@/Components/ui/label';
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/Components/ui/select';
import { Toaster } from '@/Components/ui/toast';
import { useToast } from '@/Components/ui/toast/use-toast';
import { useForm } from '@inertiajs/vue3';

defineProps({
    images: {
        type: Array,
        default: () => {},
    },
});

const form = useForm({
    image: null,
});

function submit() {
    console.log(form.image);
    form.delete(route('image.destroy'));
    if (form.image != null && !form.errors.image) {
        toast({
            title: 'Deleted',
            description: 'Successfully Deleted Image',
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
                <CardTitle>Delete Image</CardTitle>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit">
                    <div class="grid w-full items-center gap-4">
                        <div class="flex flex-col space-y-1.5">
                            <Label for="name">Images</Label>
                            <Select v-model="form.image">
                                <SelectTrigger class="w-full">
                                    <SelectValue
                                        placeholder="Select an Image"
                                    />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>Images</SelectLabel>
                                        <SelectItem
                                            v-for="image in images"
                                            :key="image.id"
                                            :value="JSON.stringify(image)"
                                        >
                                            {{ image.image_description }}
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <Toaster />
                            <Button id="delete" type="submit">Delete</Button>
                        </div>
                    </div>
                </form>
            </CardContent>
        </Card>
    </section>
</template>
