import { clsx, } from "clsx"
import { twMerge } from "tailwind-merge"

export function cn(...inputs) {
  return twMerge(clsx(inputs))
}


export const Status = {
    TODO: 'To Do',
    INPROGRESS: 'In Progress',
    ONREVIEW: 'On Review',
    DONE: 'Done',
    UNKNOWN: 'Unknown'
}

export const Priority ={
    URGENT: 'Urgent',
    HIGH: 'High',
    MEDIUM: 'Medium',
    LOW: 'Low',
    UNKNOWN: 'Unknown'
}