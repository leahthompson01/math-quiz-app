import {Dispatch, PropsWithChildren, SetStateAction} from "react";
import {selectedAnswersObj} from "@/Pages/Problems";

type Props =  PropsWithChildren<{
    selectedAnswer: number | undefined;
    setSelectedAnswer: Dispatch<SetStateAction<number | undefined>>;
    setSelectedAnswersHash : Dispatch<SetStateAction<selectedAnswersObj>>;
    currentQuestionIndex : number;
}
>


export default function AnswerChoiceBox({children, selectedAnswer, setSelectedAnswer, setSelectedAnswersHash, currentQuestionIndex} : Props){
    console.log(selectedAnswer);
    function handleClick(){
        setSelectedAnswer(Number(children?.toString()))
        // if(selectedAnswer !== undefined) {
        //     setSelectedAnswersHash((prevState) => {return {...prevState,[currentQuestionIndex] : selectedAnswer}}
        //     )
        //     // {
        //     //     let newObj = {...prevState};
        //     //     if(!Object.keys(newObj).includes(currentQuestionIndex){
        //     //         newObj[currentQuestionIndex] = selectedAnswer;
        //     //     })
        //     // });
        // }
        }
    return(
        <button type="button" className={`transition-colors ease-in-out flex text-base py-4  w-full h-24 bg-blue-200 justify-center items-center focus:border-blue-600 hover:bg-blue-600 rounded-2xl ${selectedAnswer == children?.toString() ? "bg-blue-600" : "bg-blue-200"}`}
        onClick={handleClick}>
            {children}
        </button>
    )
}