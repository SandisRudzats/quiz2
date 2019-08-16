<template>

    <div>

        <h2 class="question">
            {{ currentQuestion.text }}
        </h2>
        <div class="answer_buttons">
            <template v-for="answer in currentQuestion.answers">
                <button @click="selectAnswer(answer)"
                        class="btn"
                        :class="getAnswerButtonClass(answer)">
                    {{ answer.text }}
                </button>
            </template>
        </div>
        <div class="progress-bar">
            <div class="progress-bar_inner" v-bind:style="{width: progress + '%'}">
                {{ progress + '%'}}
            </div>
        </div>
        <button class="btn btn-primary" id="btn_next" @click="getNextQuestion();start();"

                :disabled="isButtonDisabled">
            next question
        </button>
    </div>
</template>

<script>
    import axios from 'axios';
    import {Answer, Question, Result} from "../models/quiz.models";

    export default {
        props: {
            /** @type {Question} */
            currentQuestion: {
                required: true,
            }
        },

        data() {
            return {
                progress: 0,
                /** @type {?Answer} */
                selectedAnswer: null,
                /** @type boolean */
                loading: false,
            }
        },
        methods: {
            start: function () {

                this.progress += 25;
            },
            selectAnswer(answer) {
                this.selectedAnswer = answer;
            },
            getAnswerButtonClass(answer) {
                return {
                    'btn-success': answer === this.selectedAnswer,
                    'btn-light': answer !== this.selectedAnswer,
                }
            },
            getNextQuestion() {
                if (this.isButtonDisabled) {
                    return;
                }
                let data = new FormData;
                data.append('answerId', this.selectedAnswer.id);
                this.loading = true;
                axios.post('/quiz/next-question', data)
                    .then((response) => {
                        if (response.data.error) {
                            window.alert(response.data.error);
                            return;
                        }
                        if (response.data.resultData) {
                            this.onResultsReceived(response.data.resultData);
                            return;
                        }
                        // let data = response.data;
                        this.selectedAnswer = null;
                        let nextQuestion = Question.fromArray(response.data.questionData);
                        this.currentQuestion.id = nextQuestion.id;
                        this.currentQuestion.text = nextQuestion.text;
                        this.currentQuestion.answers = nextQuestion.answers;


                    })
                    .finally(() => {
                        this.loading = false;
                    })
            },
            onResultsReceived(resultData) {
                let result = Result.fromArray(resultData);
                this.$emit('results-received', result);

            }
        },
        computed: {
            isButtonDisabled() {
                return !this.selectedAnswer || this.loading;
            }
        }
    }
</script>

<style scoped>
    .progress-bar_inner {
        height: 100%;
        background-color: #bc9c73;
        text-align: center;
        border-radius: 5px;
        padding: 15px;
    }
    .progress-bar {

        width: 100%;
        height: 75px;
        background-color: rgba(45, 179, 187, 0.35);
        padding: 15px;
        border-radius: 5px;


    }

</style>