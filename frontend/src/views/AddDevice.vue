<template>
  <div>
    <div class="container mt-3">
			<router-link to="/" class="btn btn-primary">Home</router-link>

      <h1 class="mb-5">Device Lists</h1>

			<form @submit.prevent="addDevice" class="mb-4">
				<div class="row g-3 align-items-center">
					<div class="col-auto">
						<input type="text" class="form-control" placeholder="Name" v-model="formData.name">
					</div>
					<div class="col-auto">
						<input type="text" class="form-control" placeholder="Number" v-model="formData.number">
					</div>
					<div class="col-auto">
						<button type="submit" class="btn btn-primary">Add</button>
					</div>
				</div>
			</form>

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">id</th>
            <th scope="col">Name</th>
            <th scope="col">Number</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(device, i) in devices" :key="device.id">
            <th scope="row">{{ i + 1 }}</th>
            <td>{{ device.id }}</td>
            <td>{{ device.name }}</td>
            <td>{{ device.number }}</td>
            <td>{{ device.status }}</td>
            <td>
							<button type="button" class="btn btn-sm btn-danger" @click="deleteDevice(device.id)">Del</button>
							<router-link v-if="device.status != 'Connected'" :to="`scan-device/${device.id}`" class="btn btn-sm btn-primary">Scan</router-link>
						</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
			formData: {
				name: '',
				number: ''
			},
			devices: {}
		};
  },
  methods: {
		getDevices() {
			axios.get('device')
				.then(res => {
					this.devices = res.data;
				})
		},
		addDevice() {
			axios.post(`device`, this.formData)
				.then(res => {
					alert(res.data.message);

					this.getDevices();
					this.clearForm();
				})
				.catch(err => {
					alert(err.response.data.message);
				});
		},
		deleteDevice(id) {
			axios.delete(`device/${id}`)
				.then(res => {
					alert(res.data.message);

					this.getDevices();
				});
		},
		clearForm() {
			this.formData.name = '';
			this.formData.number = '';
		}
	},
	created() {
		this.getDevices();
	}
};
</script>