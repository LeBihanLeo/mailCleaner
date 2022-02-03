// ./components/NavLink.vue
<script type="module">
export default {
	name: 'NavLink',
	props: ['url', 'text']
}
</script>

<template>
	<a :href="url">{{ text }}</a>
</template>