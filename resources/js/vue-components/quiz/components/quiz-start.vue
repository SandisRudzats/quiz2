<template>

    <div class="quiz_selector">
        <h1>hi, {{ name }}!</h1>

        <select class="dropdown" v-model="selectedQuizId">
            <option class="dropdown_select" value="">please select a quiz</option>
            <option :value="quiz.id" v-for="quiz in quizzes">
                {{quiz.title}}
            </option>

        </select>
        <button class="start_button" @click="startQuiz" :disabled="!canStartQuiz">
            start
        </button>
    </div>
</template>

<script>
    import axios from 'axios';
    import {Question} from "../models/quiz.models.js";

    export default {
        props: {
            name: {
                required: true,
            },
            quizzes: {
                default: [],
                require: true,
            },
        },
        data() {
            return {
                selectedQuizId: '',
                loading: false,

            }
        },
        methods: {
            startQuiz() {
                if (!this.canStartQuiz) {
                    return;
                }

                let data = new FormData;
                data.append('quizId', this.selectedQuizId);

                this.loading = true;


                axios.post('/quiz/start', data).then((response) => {
                    if (response.data.error) {
                        window.alert(response.data.error);
                        return;
                    }
                    let question = Question.fromArray(response.data.questionData);
                    this.$emit('quiz-started', {
                        'quizId': this.selectedQuizId,
                        'firstQuestion': question,
                    });

                }).finally(() => {
                    this.loading = false;
                });

            }

        },
        computed: {
            canStartQuiz() {
                return !!this.selectedQuizId && !this.loading;
            }
        }

    }
</script>

<style scoped>
    .quiz_selector {
        font-size: 25px;

    }

    .start_button {
        width:150px;
        height: 50px;
        background: #bc9c73;
        border-radius: 5px;
        color:black;
        border:solid 3px antiquewhite;
    }
    .dropdown {
        width: 90%;
        height: 50px;
    }
    select.dropdown {
        margin-top: 25px;
        border-radius: 7px;
        margin-bottom: 30px;
    }
</style>