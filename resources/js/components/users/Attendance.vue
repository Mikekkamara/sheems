<template>
    <div>
        <b-modal visible id="user-modal" size="lg" scrollable centered hide-footer hide-header
            content-class="template-modal" header-class="template-modal-header">
            <div class="d-flex flex-row justify-content-end" style="position: sticky; top: 0; z-index: 20">
                <vs-button danger icon circle @click="$bvModal.hide('user-modal')">
                    <i class="fa-duotone fa-times-circle h5 m-0"></i>
                </vs-button>
            </div>
            {{ userId }}
        </b-modal>
    </div>
</template>

<script>
export default {
    props: {
        userId: {
            required: true,
            type: String
        }
    }
}
</script>
