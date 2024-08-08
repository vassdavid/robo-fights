<template>
  <div v-if="robots.length > 0">
    <h2>Robot Fighters</h2>
    <ul class="list-group mt-3">
      <li v-for="robot in robots" :key="robot.id" class="list-group-item d-flex justify-content-between align-items-center">
        <img height="50" width="50" :src="robot.imageUrl"/>
        <span class="mx-3">{{ robot.name }} (id: {{ robot.id }})</span>
        <button @click="removeRobot(robot.id)" class="btn btn-danger btn-sm">Remove</button>
      </li>
    </ul>

    <button v-if="robots.length == 2" @click="compareRobots" class="btn btn-success mt-3">Start Robot Fight</button>

    <div v-if="comparisonResult" class="mt-3">
      <h3>Comparison Result</h3>
      <div class="alert alert-info">
        Stronger Robot: {{ comparisonResult.name }} with power {{ comparisonResult.power }}
      </div>
    </div>
    <div v-if="errorMessage" class="mt-3">
      <h3>Error</h3>
      <div class="alert alert-danger">
        {{errorMessage}}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      robots: [],
      comparisonResult: null,
      errorMessage: null,
    };
  },
  created() {
    this.loadRobotsFromLocalStorage();
    window.addEventListener('storage', this.loadRobotsFromLocalStorage);
  },
  beforeDestroy() {
    window.removeEventListener('storage', this.loadRobotsFromLocalStorage);
  },
  methods: {
    loadRobotsFromLocalStorage() {
      const robots = JSON.parse(localStorage.getItem('robots')) || [];
      this.robots = robots;
      this.comparisonResult = null;
      this.errorMessage = null;
    },
    removeRobot(id) {
      this.robots = this.robots.filter(robot => robot.id !== id);
      localStorage.setItem('robots', JSON.stringify(this.robots));
      this.comparisonResult = null;
      this.errorMessage = null;
    },
    compareRobots() {
      if (this.robots.length < 2) {
        alert('At least 2 robots are needed for comparison.');
        return;
      }

      fetch('/fight', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          robot1Id: parseInt(this.robots[0].id),
          robot2Id: parseInt(this.robots[1].id),
        }),
      })
      .then(response => {
        if (!response.ok) {
          return response.json().then(errorData => {
            this.errorMessage = errorData.message || 'Unexpected error!';
            throw new Error(errorData.message || 'Request failed with status ' + response.status);
          });
        }
        return response.json()
      })
      .then(data => {
        this.comparisonResult = data.robot;
      })
      .catch(error => {
        console.error('Error:', error);
      });
    }
  },
};
</script>

<style scoped>

</style>
