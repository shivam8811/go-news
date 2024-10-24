<script setup>
const socialMediaList =  [
    { icon: 'mdi-facebook', url: 'https://www.facebook.com' },
    { icon: 'mdi-twitter', url: 'https://www.twitter.com' },
    { icon: 'mdi-linkedin', url: 'https://www.linkedin.com' },
    { icon: 'mdi-instagram', url: 'https://www.instagram.com' },
]
</script>

<template>
    <div class="the-footer">
        <strong>Connect on social networks!</strong>

        <v-spacer></v-spacer>

        <div class="d-flex">
            <v-btn
                v-for="socialMedia in socialMediaList"
                :key="socialMedia.url"
                :icon="socialMedia.icon"
                size="small"
                variant="plain"
                :href="socialMedia.url"
                target="_blank"
            ></v-btn>
        </div>

        <div class="copyright">
            <v-icon icon="mdi-copyright" size="small"></v-icon>
            <strong>Shivam</strong>
        </div>
    </div>
</template>

<style scoped>
    .the-footer {
        color: white;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        background: var(--color-primary);
    }

    .copyright {
        display: flex;
        gap: 2px;
        align-items: center;
    }
</style>
