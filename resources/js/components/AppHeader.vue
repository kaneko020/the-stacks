<template>
    <header class="app-header">
        <div class="container">
            <div class="header-content">
                <h1 class="app-title">Laravel + Vue 3 + SQLite</h1>
            </div>
        </div>
    </header>
</template>

<script setup lang="ts">
</script>

<style scoped>
.header-content {
    display: flex;
    align-items: center;
    padding: 0 40px;
}

.app-title {
    font-size: 1.5rem;
    font-weight: bold;
    margin: 0;
    color: #e9e9e9;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

.app-header {
    position: relative;
    z-index: 200;
    background-color: var(--bg-navy);
    box-shadow: 0 2px 5px 1px rgba(157, 183, 255, 0.3);
    padding: 1rem 0;
    height: 64px;
    display: flex;
    align-items: center;
}
</style>
