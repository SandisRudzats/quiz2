<template>
    <div>
        <h1>quiz results</h1>

        <p>You have answered correctly to {{ result.correctAnswerCount}}
            out of {{currentQuiz.questionCount}} questions </p>
        <button @click="endQuiz">Go to start</button>
    </div>
</template>

<script>
    export default {
        props: {
            /**
             * @type {Quiz}
             */
            currentQuiz: {
                required: true,
            },
            /**
             * @type {Result}
             */
            result: {
                required: true,
            }
        },
        methods: {
            endQuiz() {
                this.$emit('quiz-finished');
            },

        }

    }
</script>

<style scoped>
    button {
        width: 150px;
        height: 50px;
        background: #bc9c73;
        border-radius: 5px;
        color: black;
        font-size: 25px;
        border:solid 3px antiquewhite;
    }

    p {
        font-size: 25px ;

    }
</style>