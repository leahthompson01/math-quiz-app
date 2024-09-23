import {Dispatch, PropsWithChildren, SetStateAction} from "react";

type Props =  PropsWithChildren<{
    selectedAnswer: number | undefined;
    setSelectedAnswer: Dispatch<SetStateAction<number | undefined>>;
}
>
export default function AnswerChoiceBox({children, selectedAnswer, setSelectedAnswer} : Props){
    console.log(selectedAnswer);
    return(
        <button className={`transition-colors ease-in-out flex text-base py-4  w-full h-24 bg-blue-200 justify-center items-center focus:border-blue-600 hover:bg-blue-600 rounded-2xl ${selectedAnswer == children?.toString() ? "bg-blue-600" : "bg-blue-200"}`}
        onClick={() => setSelectedAnswer(Number(children?.toString()))}>
            {children}
        </button>
    )
}