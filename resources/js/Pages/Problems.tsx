import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import {PageProps, User} from '@/types';
import AnswerChoiceBox from "@/Components/QuizComponents/AnswerChoiceBox";
import {useEffect, useState} from "react";
import {ChevronLeftIcon, ChevronRightIcon} from "@heroicons/react/20/solid";
import axios from "axios";

type ProblemObj = {
    question: string,
    answer_choices: number[],
    correct_answer_id: number
}
type ProblemsProps = {
    auth: {
        user: User;
    },
    problems: ProblemObj[],
    id: number,


}


export default function Problems({ auth, problems, id }: ProblemsProps) {
    const [currentQuestionIndex, setCurrentQuestionIndex] = useState(0);
    const [selectedAnswer, setSelectedAnswer] = useState<undefined | number>(undefined);
    const [isSubmitted,setIsSubmitted] = useState(false);
    const currentProblem = problems[currentQuestionIndex];
    const [selectedAnswersArr, setSelectedAnswersArr] = useState<(number | undefined) []>([]);

    function handleBackClick(){
        setCurrentQuestionIndex((prevValue) => prevValue - 1);
    }

    function handleNextClick(){
        setSelectedAnswersArr((prevState) => [...prevState,selectedAnswer]);
        setCurrentQuestionIndex((prevValue) => prevValue + 1);
        setSelectedAnswer(undefined)
    }

    async function handleSubmit() {
        setIsSubmitted(true);
        const url = "/quiz"
        try {
            const response = await fetch(url,{
                method:"POST"
        });

            const json = await response.json();
            console.log(json)
        } catch (error) {
            // @ts-ignore
            console.error(error);
        }
    }


    console.log('this is what the id is ', id);
    useEffect(() => {
        console.log('selectedAnswer',selectedAnswer)
        console.log('selected Answers ',selectedAnswersArr)
    }, [selectedAnswersArr, selectedAnswer])
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-white leading-tight">Problems</h2>}
        >
            <Head title="Problems" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div className={'mt-8'}>
                                    <h3 className={'text-center text-gray-700 dark:text-white'}>{currentProblem.question}</h3>
                                    <div className={'grid grid-cols-2 justify-items-center mt-8 gap-6 px-6'}>
                                    {currentProblem.answer_choices.map(el =>
                                        <AnswerChoiceBox selectedAnswer={selectedAnswer} setSelectedAnswer={setSelectedAnswer} key={el}>
                                            {el}
                                        </AnswerChoiceBox>)
                                    }
                                        <div className={'flex col-span-2 mx-auto gap-12 py-8'}>
                                            <button disabled={currentQuestionIndex === 0} onClick={handleBackClick}
                                                    className={'disabled:text-gray-400 text-blue-500 '}>
                                                <ChevronLeftIcon className={`size-12 disabled:text-gray-400`}/>
                                            </button>
                                            <button disabled={selectedAnswersArr.length !== 9} className={'disabled:text-gray-400'}
                                            onClick={() => handleSubmit()}>
                                                Submit
                                            </button>
                                            <button disabled={currentQuestionIndex === 9 || selectedAnswer === undefined} onClick={handleNextClick}
                                            className={'disabled:text-gray-400 text-blue-500'}>
                                                <ChevronRightIcon className="size-12"/>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
