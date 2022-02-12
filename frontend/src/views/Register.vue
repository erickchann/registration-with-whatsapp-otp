<template>
	<div>
		<div class="container mt-5">
			<h1 class="title">Register</h1>

			<form class="mt-4" v-if="otpState">
				<input type="number" class="form-control mb-2" placeholder="OTP">

				<button type="submit" class="btn btn-primary mt-3">Confirm</button>
			</form>
			
			<form class="mt-4" @submit.prevent="regis" v-if="!otpState">
				<input type="text" class="form-control mb-2" placeholder="Username" v-model="formData.name">
				<input type="number" class="form-control mb-2" placeholder="Number" v-model="formData.number">
				<input type="password" class="form-control" placeholder="Password" v-model="formData.password">

				<button type="submit" class="btn btn-primary mt-3">Register</button>
			</form>
		</div>
	</div>
</template>

<script>
import axios from 'axios'

export default {
	data() {
		return {
			otpState: false,
			formData: {
				name: '',
				number: '',
				password: ''
			}
		}
	},
	methods: {
		regis() {
			axios.post(`register`, this.formData)
				.then(res => {
					if (res.data.success) {
						this.otpState = true;
					} else {
						alert("Terjadi Kesalahan");
					}
				})
		}
	},
}
</script>