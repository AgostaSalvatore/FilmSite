import { useRef, useEffect } from 'react';
import { gsap } from 'gsap';
import { useGSAP } from '@gsap/react';

gsap.registerPlugin(useGSAP);

const SplitText = ({
    text,
    className = '',
    delay = 100,
    duration = 0.6,
    ease = 'power3.out',
    splitType = 'chars',
    from = { opacity: 0, y: 40 },
    to = { opacity: 1, y: 0 },
    textAlign = 'center',
    tag = 'p',
    onLetterAnimationComplete
}) => {
    const containerRef = useRef(null);

    // Funzione per splittare manualmente il testo
    const splitTextManually = (element, type) => {
        const text = element.textContent;
        element.innerHTML = '';

        if (type === 'chars' || type.includes('chars')) {
            // Split per caratteri
            const chars = text.split('');
            chars.forEach((char) => {
                const span = document.createElement('span');
                span.style.display = 'inline-block';
                span.style.whiteSpace = 'pre'; // Preserva gli spazi
                span.textContent = char;
                span.className = 'split-char';
                element.appendChild(span);
            });
            return element.querySelectorAll('.split-char');
        } else if (type === 'words' || type.includes('words')) {
            // Split per parole
            const words = text.split(' ');
            words.forEach((word, index) => {
                const span = document.createElement('span');
                span.style.display = 'inline-block';
                span.textContent = word;
                span.className = 'split-word';
                element.appendChild(span);

                // Aggiungi spazio dopo ogni parola tranne l'ultima
                if (index < words.length - 1) {
                    element.appendChild(document.createTextNode(' '));
                }
            });
            return element.querySelectorAll('.split-word');
        }

        return [];
    };

    useGSAP(
        () => {
            if (!containerRef.current || !text) return;

            const element = containerRef.current;
            const targets = splitTextManually(element, splitType);

            if (targets.length === 0) return;

            // Anima gli elementi
            gsap.fromTo(
                targets,
                { ...from },
                {
                    ...to,
                    duration,
                    ease,
                    stagger: delay / 1000,
                    onComplete: () => {
                        onLetterAnimationComplete?.();
                    }
                }
            );

            return () => {
                // Cleanup: ripristina il testo originale
                if (element) {
                    element.textContent = text;
                }
            };
        },
        {
            dependencies: [text, delay, duration, ease, splitType, JSON.stringify(from), JSON.stringify(to)],
            scope: containerRef
        }
    );

    const style = {
        textAlign,
        overflow: 'visible',
        display: 'block',
        whiteSpace: 'normal',
        wordWrap: 'break-word',
        width: '100%',
        color: '#ffffff'
    };

    const classes = `split-parent ${className}`;

    const TagComponent = tag;

    return (
        <TagComponent ref={containerRef} style={style} className={classes}>
            {text}
        </TagComponent>
    );
};

export default SplitText;
