export function fuWord(str) {
    let lower = str.toLowerCase()
    return lower.charAt(0).toUpperCase() + lower.slice(1)
} 